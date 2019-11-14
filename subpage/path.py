import os

def geneFile(file,pos):
    line = '<li data-caption="' + file + '" path="' + pos + '"></li>'
    print(file)
    file_o.write(line)

def geneDir(fileDir):
    for root, dirs, files in os.walk(fileDir):
        for file in files:
            pos = os.path.join(root, file).replace('\\','/')
            geneFile(file,pos)
            
        for dir in dirs:
            head = '<li data-caption="' + dir + '" data-collapsed="true"><ul>'
            foot = '</ul></li>'
            file_o.write(head)
            path = os.path.join(root, dir).replace('\\','/')
            print(path)
            geneDir(path)
            file_o.write(foot)
            
        break

fileDirVideos = "./vid/"
fileDirMusics = "./mus/"
fileNameHtmlVideos = "treeVideos.html"
fileNameHtmlMusics = "treeMusics.html"

with open(fileNameHtmlVideos,mode='w+',encoding='utf-8') as file_o:
    geneDir(fileDirVideos)
with open(fileNameHtmlMusics,mode='w+',encoding='utf-8') as file_o:
    geneDir(fileDirMusics)

os.system("pause")

