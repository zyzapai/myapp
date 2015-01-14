#!/usr/bin/env python  
# -*- coding:utf-8 -*-  
 
import tornado.ioloop  
import tornado.web  
  
class MainHandler(tornado.web.RequestHandler):  
    def post(self): 
	ret = {"code":200} 
        self.write(ret)  
  
application = tornado.web.Application([  
    (r"/",MainHandler),  
])  
  
if __name__=="__main__":  
    application.listen(8888)  
    tornado.ioloop.IOLoop.instance().start() 
