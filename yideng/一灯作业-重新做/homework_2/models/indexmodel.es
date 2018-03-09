import rp from 'request-promise';
class indexModel{
    contructor(ctx){
        this.ctx=ctx;
    }
    updateNum(){
        const options = {
            uri:'http://0.0.0.0:8888/praise.php',
            method:'GET'
        }
        return new Promise((resolve,reject)=>{
            rp(options).then(function(result){
                const info = JSON.parse(result);
                if(info){
                    resolve({ data: info});
                }else{
                    reject({});
                }
            })
        })
    }
}
export default indexModel;