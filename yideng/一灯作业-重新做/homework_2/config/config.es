import path from 'path';
const Config = new Map();
Config.set('port',3000);
Config.set('staticDir',path.join(__dirname,'..','public'));
Config.set('viewDir',path.join(__dirname,'..','views'));
export default Config;