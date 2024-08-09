######环境依赖
php 7.4.3

#####参数配置
数据库链接：http://www.newstudent.com:86/phpMyAdmin4.8.5/
数据库密码和账号在 db_connect.php里修改，需要改成自己的


######部署步骤


######目录表述
├── readme.md             //help
├── Frontrecruitmentsystem   //前端部分招新系统文件夹
│   ├── apple_fonts                            
│   │   ├── PingFang Light.ttf
│   │   ├── PingFang Medium.ttf               
│   │   ├── PingFang Regular.ttf         
│   │   ├── PingFang Semibold.ttf          
│   │   ├── PingFang Thin.ttf           
│   │   └── PingFang Ultralight.ttf    
│   ├── css
│   │   ├── application.css
│   │   ├── background.css              
│   │   ├── department_intro.css       
│   │   ├── detail_department_intro.css             
│   │   ├── font_family.css          
│   │   ├── header.css
│   │   ├── index.css
│   │   ├── introduction.css               
│   │   ├── popup.css       
│   │   ├── public.css          
│   │   └── test.css       
│   ├──  html
│   │   ├── application.html  //报名页面
│   │   ├── department_intro.html //简介       
│   │   ├── detail_department_intro.html  //详细简介
│   │   ├── introduction.html  //三翼介绍
│   │   ├── test.html        //测试个人部门页面
│   │   └── 测试.html
│   ├── img
│   │   ├── cats        
│   │   ├── departments  
│   │   └── 一堆图片
│   ├── js
│   │   ├── ajax.js      
│   │   ├── application.js  //前后端交互信息在里面
│   │   ├── department_intro.js  
│   │   ├── detail_department_intro.js
│   │   ├── flexible.js
│   │   └── test.js
│   └──  less
├── error
├── vendor  //composer自带
├── .htaccess
├── composer.json             // phpoffice版本
├── composer.look
├── db_connect.php       //连接数据库
├── index.html             //首页
├── newstudent.sql               //数据库
├── nginx.htaccess
├── update.php            //提交申请表
└── recruitmentsystem.md                  //接口文档


#####运行的操作、前提
1、建表、确保密码账号与db_connect.php一致
2、确认是否在Nginx1.15.11下
3、确保安装composer引入第三方库phpSpreadsheet