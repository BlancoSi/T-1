import os

def geneFile(file,pos):
    line = '<li data-caption="' + file + '" path="' + pos + '"></li>'
    print(file)
    file_o.write(line)

def geneDir(fileDir):
    for root, dirs, files in os.walk(fileDir):
        for file in files:
            pos = os.path.join(root, file).replace('\\','/')
            if file.find('.vtt') == -1:
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

fileDirVideo = "./vid/"
fileDirMusic = "./mus/"
fileDirResource = "./res/"

fileNameHtmlVideo = "treeVideo.html"
fileNameHtmlMusic = "treeMusic.html"
fileNameHtmlResource = "treeResource.html"

with open(fileNameHtmlVideo,mode='w+',encoding='utf-8') as file_o:
    geneDir(fileDirVideo)
with open(fileNameHtmlMusic,mode='w+',encoding='utf-8') as file_o:
    geneDir(fileDirMusic)
with open(fileNameHtmlResource,mode='w+',encoding='utf-8') as file_o:
    geneDir(fileDirResource)

os.system("pause")

