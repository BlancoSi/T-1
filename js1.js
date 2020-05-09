var msg = ''
var cmds = null
var user = 'guest'

var enableinput = true
var usedcmds = new Array()
var cmdnum = 0

function enableInput(boolInput){
    enableinput = boolInput
}

function initHello () {
    var url = "cmds.json"
    var request = new XMLHttpRequest();
    request.open("get", url);
    request.send(null);
    request.onload = function () {
        if (request.status == 200) {
            cmds = JSON.parse(request.responseText);
            // console.log(cmds);
        }
    }
    this.cmdnum = this.usedcmds.push('Hello') - 1
    this.msg = this.usedcmds[this.cmdnum]
    document.getElementById("add").innerHTML = msg
}

window.addEventListener('keydown', (event)=> {
    if (enableinput == false){return false}
    // console.log(event)
    if (event.key === 'Backspace') {
        msg = msg.substr(0, msg.length - 1)
        document.getElementById("add").innerHTML = msg
        return
    } else if (msg.length <= 10 && (event.key === ' ' || /^\w{0,1}$/.test(event.key))) {
        if (msg !== ''){
            cmdnum = usedcmds.length - 1
        }
        msg += event.key
        document.getElementById("add").innerHTML = msg
        usedcmds[cmdnum] = msg
        return
    } else if (event.key === 'Enter' && msg !== '') {
        enter(msg)
        while(msg.length > 0){
            msg = msg.substr(0, msg.length - 1)
            document.getElementById("add").innerHTML = msg
        }
        cmdnum = usedcmds.push(msg) - 1
        return
    } else if (event.key === 'ArrowUp') {
        if (cmdnum > 0){
            cmdnum -= 1
            document.getElementById("add").innerHTML = usedcmds[cmdnum]
            msg = usedcmds[cmdnum]
        } 
    } else if (event.key === 'ArrowDown') {
        if (cmdnum < usedcmds.length - 1){
            cmdnum += 1
            document.getElementById("add").innerHTML = usedcmds[cmdnum]
            msg = usedcmds[cmdnum]
        } 
    }
    
}, false)

document.oncontextmenu = () => { return false }

function enter (msg) {
    // console.log(msg)
    if (user == 'guest') {
        creatTable('>$ ' + msg)
    } else if (user == 'root') {
        creatTable('># ' + msg)
    }
    cmd(msg)
    return 0
}

function creatTable (msg) {
    var tableData="<tr>"
    tableData+="<td>"+msg+"</td>"
    tableData+="</tr>"
    document.getElementById("table1").innerHTML += tableData
}

function cmd (msg) {
    msg = msg.replace( /\s+/g ,"_")
    if (!isNaN(msg)) {
        //msg为数字
        return
    }
    msg = "cmds." + msg
     console.log(msg)
    var cmd = eval(msg)
    // console.log(cmd)
    eval(cmd)
}
