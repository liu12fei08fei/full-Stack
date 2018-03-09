import requestsuper from 'supertest';
import app from '../app-es.js';
function request(){
    return requestsuper(app.listen());
}
describe('接口测试', function () {
    it('点赞加一', function (done) {
        request(app)
            .get('index/update')
            .expect(200,)
            .end(function(err,res){
                if(res.data==1)return done(err);
                done();
            })
    });
});
// 执行 mocha server.js