//TEST FOR FILE : UPDATEMODULE.PHP
function ManageModuleAdd(){
  let path = document.getElementById("pathA").value;
  let lx = document.getElementById("lxA").value;
  let ly = document.getElementById("lyA").value;
  var pathlistA = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
  pathlistA.forEach(pathlistElement => {
    if(pathlistElement == path){
      alert("path already in list");
      return false;
    }   
  });

//test for value of path
  if (!(typeof path === "string" && path.trim().length > 0)){
    alert("Enter Valid Path");
    return false;
  }
  else if(!(path.endsWith(".glb"))){
    alert("File is not of extention .glb");
    return false;
  }
//test for validity of location
  if(lx<0 || ly<0){
    alert("Enter Valid position (both values must be positive)");
    return false;
  }
//test for validity of postId
  if(lx<0 || ly<0){
    alert("Enter Valid position (both values must be positive)");
    return false;
  }
  return true;  
}


function ManageModuleModify(){
  let cond = document.getElementById("cond").value;
  let path = document.getElementById("pathM").value;
  let lx = document.getElementById("lxM").value;
  let ly = document.getElementById("lyM").value;
  let test = false;
  var pathlistM = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
  pathlistM.forEach(pathlistElement => {
    if(pathlistElement == cond){
      test = true;
      console.log("element found");
      
    }   
  });
  if(!(test)){
    alert("elemnt does not exist");
    return false;
  }
  const pathlist = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
//test for value of path
  if (!(typeof path === "string" && path.trim().length > 0)){
    alert("Enter Valid Path");
    return false;
  }
  else if(!(path.endsWith(".glb"))){
    alert("File is not of extention .glb");
    return false;
  }
//test for validity of location
  if(lx<0 || ly<0){
    alert("Enter Valid position (both values must be positive)");
    return false;
  }
  return true;  
}





function ManageModuleDelete(){
  let path = document.getElementById("pathD").value;

  let test = false;
  var pathlistM = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
  pathlistM.forEach(pathlistElement => {
    if(pathlistElement == path){
      test = true;
      console.log("element found");
      
    }   
  });
  if(!(test)){
    alert("elemnt does not exist");
    return false;
  }
  const pathlist = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
//test for value of path
  if (!(typeof path === "string" && path.trim().length > 0)){
    alert("Enter Valid Path");
    return false;
  }
  return true;  
}


//TEST FOR FILE : UPDATECOUNTRY.PHP

function ManageCountryAdd(){
  let name = document.getElementById("nameA").value;
  let lx = document.getElementById("lxCA").value;
  let ly = document.getElementById("lyCA").value;
  let idPost = document.getElementById("idpA").value;
  var pathlistA = Array.from(document.querySelectorAll('.namelist')).map(span => span.textContent.trim());


  pathlistA.forEach(pathlistElement => {
    if(pathlistElement == name){
      alert("name already in list");
      return false;
    }   
  });

//test for value of path
  if (!(typeof name === "string" && name.trim().length > 0 && name.trim().length< 20)){
    alert("Enter Valid name");
    return false;
  }

//test for validity of location
  if(lx<0 || ly<0){
    alert("Enter Valid position (both values must be positive)");
    return false;
  }
  if(idPost<0){
    alert("Enter Valid id (value must be positive)");
    return false;
  }
  return true;  
}


function ManageCountryModify(){
  let cond = document.getElementById("condM").value;
  let path = document.getElementById("nameM").value;
  let lx = document.getElementById("lxCM").value;
  let ly = document.getElementById("lyCM").value;
  let idPost = document.getElementById("idpM").value;

  let test = false;
  var pathlistM = Array.from(document.querySelectorAll('.namelist')).map(span => span.textContent.trim());
  pathlistM.forEach(pathlistElement => {
    if(pathlistElement == cond){
      test = true;
      console.log("element found"); 
    }   
  });
  if(!(test)){
    alert("elemnt does not exist");
    return false;
  }
  const pathlist = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
//test for value of path
  if (!(typeof path === "string" && path.trim().length > 0)){
    alert("Enter Valid Path");
    return false;
  }
//test for validity of location
  if(lx<0 || ly<0){
    alert("Enter Valid position (both values must be positive)");
    return false;
  }
//test for validity of postId
  if(idPost<0){
    alert("Enter Valid id (values must be positive)");
    return false;
  }
  return true;  
}





function ManageCountryDelete(){
  let path = document.getElementById("nameCD").value;

  let test = false;
  var pathlistM = Array.from(document.querySelectorAll('.namelist')).map(span => span.textContent.trim());
  pathlistM.forEach(pathlistElement => {
    if(pathlistElement == path){
      test = true;
      console.log("element found");
      
    }   
  });
  if(!(test)){
    alert("elemnt does not exist");
    return false;
  }
  const pathlist = Array.from(document.querySelectorAll('.pathlist')).map(span => span.textContent.trim());
//test for value of path
  if (!(typeof path === "string" && path.trim().length > 0)){
    alert("Enter Valid Path");
    return false;
  }
  return true;  
}

