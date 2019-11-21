import os

f = open('bro.html',mode='r',encoding='utf-8')
Vf_plug = open('treeVideo.html',mode="r",encoding='utf-8')
Mf_plug = open('treeMusic.html',mode="r",encoding='utf-8')
Rf_plug = open('treeResource.html',mode="r",encoding='utf-8')
Pf_plug = open('treePosts.html',mode="r",encoding='utf-8')
f_new = open('index.html',mode="w+",encoding='utf-8')

V_coutents = Vf_plug.read()
V_path = '<!--#include file="treeVideo.html" -->'
M_coutents = Mf_plug.read()
M_path = '<!--#include file="treeMusic.html" -->'
R_coutents = Rf_plug.read()
R_path = '<!--#include file="treeResource.html" -->'
P_coutents = Pf_plug.read()
P_path = '<!--#include file="treePosts.html" -->'

for line in f:
    f_new.write(line)
    # print(line)
    if V_path in line:
        print(V_path)
        f_new.write(V_coutents+"\n")
    if M_path in line:
        print(M_path)
        f_new.write(M_coutents+"\n")
    if R_path in line:
        print(R_path)
        f_new.write(R_coutents+"\n")
    if P_path in line:
        print(P_path)
        f_new.write(P_coutents+"\n")

# os.system("pause")
