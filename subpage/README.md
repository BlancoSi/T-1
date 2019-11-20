运行process.ps1

或者：
1. python3 path.py
2. python3 refresh.py

脚本描述：
扫描./mus ./vid等
生成treeMusics.html和treeVideos.html等
tree插入bro.html生成output.html

软连接生成方式（win）：
	powershell> New-Item -ItemType SymbolicLink -Path xxxx -Target xxxx