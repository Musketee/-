
var express = require('express');
var router = require('./router');
var bodyParser = require('body-parser');

var app = express();

app.use('/node_modules/', express.static('./node_modules/'))
app.use('/public/', express.static('./public/'))
app.engine('html', require('express-art-template'))

// 配置模板引擎和 body-parser 一定要在 app.use(router) 挂载路由之前
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

//挂载路由
app.use(router);

// app.get('/', function (req, res) {
//   fs.readFile('./db.json','utf8', function (err, data) {
//     if (err) {
//       return res.send('404 Not Found');
//     }
//     // console.log(data);
//     res.render('index.html', {
//       fruits:[
//         '苹果',
//         '香蕉',
//         '橘子'
//       ],
//       students: JSON.parse(data).students
//     });
//
//   });
//
//
// });


app.listen(3000, function () {
  console.log('running 3000...')
});
