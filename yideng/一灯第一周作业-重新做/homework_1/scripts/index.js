class PraiseButton{
    constructor(num,element){
        this.num = num;
        this.element = element;
    }
    clickAction(){
        this.element.click(()=>{
            if(this.num<10){
                this.element.removeClass('hand_active');
                this.element.attr('title',this.num);
                this.num = add(this.num);
            }else{
                this.element.addClass('hand_active');
                this.element.attr('title',this.num);
                this.num = 0;
            }
            console.log(this.num);
        });
    }
}

class Thumb extends PraiseButton{
    constructor(num,element){
        super(num,element);
    }
}

export default {Thumb};