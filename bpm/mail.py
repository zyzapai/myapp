#!/usr/bin/python
#coding:utf-8
import requests

url="http://sendcloud.sohu.com/webapi/mail.send.json"
      
# 不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
params = {"api_user": "zyzapai_test_UVm8nz", \
  "api_key" : "euqatJmyxslfBGpr",\
  "to" : "zyz@apaiapp.com", \
  "from" : "service@sendcloud.im", \
  "fromname" : "ETL", \
  "subject" : "普大喜奔，用户10000开始上传数据啦!", \
  "html": " " \
}

r = requests.post(url, files={}, data=params)
print r.text
