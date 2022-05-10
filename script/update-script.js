function update(a,s){
    if(s=="IN PROGRESS"){
    document.getElementById('update').style.display='block';
    document.getElementById('sno').value = parseInt(a);
    }
}

document.getElementById('back').onclick=function(){
     document.getElementById('update').style.display='none';
}