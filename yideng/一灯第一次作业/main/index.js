(function() {
    class PraiseButton {
        // static 
        constructor(ele, num) {
            this.ele = ele;
            this.num = num;
        };
        init() {
            let ele = document.querySelector(this.ele);
            let eleName = this.ele.substr(1);
            ele.onclick = () => {
                if (this.num < 10) {
                    this.num++;
                    ele.querySelector('span').innerHTML = this.num;
                    ele.setAttribute('title', this.num);
                    if (this.num == 10) {
                        ele.className = eleName+" "+eleName+"_active";
                    }
                }
            }
        }
    }
    // 父类
    new PraiseButton('.favour', 0).init();
    // 子类
    class Thumb extends PraiseButton {
        constructor(ele, num) {
            super(ele, num);
        };
        init() {
            super.init();
        }
    }
    new Thumb('.hand', 0).init();
})();