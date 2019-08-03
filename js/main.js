
const closeshero = () => {
	document.getElementById("closehero").style.display = "none";
	document.getElementById("herosection").style.display = "none";
	document.getElementsByTagName("body")[0].classList.replace("heroimg","splace");
	document.getElementById("imagealpha").classList.replace("coverhero","nohero");
	document.getElementById("devsection").classList.replace("hide","show");
	document.getElementById("mssection").classList.replace("hide","show");
	document.getElementsByTagName("footer")[0].classList.replace("hide","show");

}

document.getElementById("closehero").addEventListener("click", closeshero);
