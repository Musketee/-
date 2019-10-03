//数据操作文件模块
/*
 *文件的增删改查都在这里完成
 */

var fs = require('fs');
var dbPath = './db.json';
/*
 *学生的查找
 */
exports.find = function (callback) {
    fs.readFile(dbPath, 'utf8', function (err, data) {
        if (err) {
            return callback(err);
        }
        callback(null, JSON.parse(data).students);
    });
};
exports.findById = function (id, callback) {
    fs.readFile(dbPath, 'utf8', function (err, data) {
        if (err) {
            return callback(err);
        }
        var students = JSON.parse(data).students;
        var ret=students.find(function (item) {
            return item.id === parseInt(id);
        });
        callback(null, ret);
    });
};
/*
 *学生的保存
 */
exports.save = function (student, callback) {
    fs.readFile(dbPath, 'utf8', function (err, data) {
        if (err) {
            return callback(err);
        }
        var students = JSON.parse(data).students;
        student.id = students[students.length-1].id+1;
        students.push(student);
        var fileData = JSON.stringify({
            students: students
        });
        fs.writeFile(dbPath, fileData, function (err) {
            if (err) {
                return callback(err)
            }
            // 成功就没错，所以错误对象是 null
            callback(null)
        })
    });
};


/*
 *学生的更新
 */
exports.update = function (student, callback) {
    fs.readFile(dbPath, function (err, data) {
        if (err) {
            return callback(err);
        }
        var students = JSON.parse(data).students;
        student.id = parseInt(student.id);
        var stu = students.find(function (item) {
            return item.id = student.id;
        });
        //拷贝(返回内容改变原数组改变?)
        for (var key in student) {
            stu[key] = student[key];
        }
        var fileData = JSON.stringify({
            students: students
        });
        fs.writeFile(dbPath, fileData, function (err) {
            if (err) {
                return callback(err);
            }
            callback(null);
        });
    });
};



/*
 *学生的删除
 */
exports.delete = function (student, callback) {
    fs.readFile(dbPath, 'utf8', function (err, data) {
        if (err) {
            return callback(err);
        }
        var students = JSON.parse(data).students;
        student.id = parseInt(student.id);
        var deleteId = students.findIndex(function (item) {
            return item.id === student.id
        });
        students.splice(deleteId, 1);
        var fileData = JSON.stringify({
            students: students
        });
        fs.writeFile(dbPath, fileData, function (err) {
            if (err) {
                return callback(err);
            }
            callback(null);
        });
    });
};