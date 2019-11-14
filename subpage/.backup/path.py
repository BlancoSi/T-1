import os

def geneFile(file):
    line = '<li data-caption="' + file + '"></li>'
    print(file)
    file_o.write(line)

def geneDir(fileDir):
    for root, dirs, files in os.walk(fileDir):
        for file in files:
            geneFile(file)
            
        for dir in dirs:
            head = '<li data-caption="' + dir + '" data-collapsed="true"><ul>'
            foot = '</ul></li>'
            file_o.write(head)
            path = os.path.join(root, dir).replace('\\','/')
            print(path)
            geneDir(path)
            file_o.write(foot)
            
        break

fileDirMus = "./vid/"
fileNameHtml = "tree.html"

with open(fileNameHtml,'w') as file_o:
    geneDir(fileDirMus)

os.system("pause")

