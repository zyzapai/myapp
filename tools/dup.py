#!/usr/bin/env python  
# -*- coding:utf-8 -*-  

import sys

lines_seen = set()
outfile = open(sys.argv[2], "w")
for line in open(sys.argv[1], "r"):
    if line not in lines_seen:
        outfile.write(line)
        lines_seen.add(line)
outfile.close()
