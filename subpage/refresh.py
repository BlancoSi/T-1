import os

f = open('bro.html',mode='r',encoding='utf-8')
Vf_plug = open('treeVideos.html',mode="r",encoding='utf-8')
Mf_plug = open('treeMusics.html',mode="r",encoding='utf-8')
f_new = open('output.html',mode="w+",encoding='utf-8')

V_coutents = Vf_plug.read()
V_path = '<!--#include file="treeVideos.html" -->'
M_coutents = Mf_plug.read()
M_path = '<!--#include file="treeMusics.html" -->'

for line in f:
    f_new.write(line)
    # print(line)
    if V_path in line:
        print(V_path)
        f_new.write(V_coutents+"\n")
    if M_path in line:
        print(M_path)
        f_new.write(M_coutents+"\n")

os.system("pause")
