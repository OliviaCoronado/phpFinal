function pageLoad(){
let titleArray = ['book 1',"book2", "book3"];
let descriptionArray = ["aaaaa", "bbbbb", "cccc"];

var dynamic = document.querySelector('.container');
for (var i = 0; i <titleArray.length; i++){
    let fetch = document.querySelector('.container').innerHTML;
    dynamic.innerHTML = 
    `<div class="boxes">
    <div class="box-content">
        <h2>${titleArray[i]}</h2>
        <p>${descriptionArray[i]}</p>
        <a href="#">Read More</a>

    </div>
</div>` + fetch ; //tutorial-https://www.youtube.com/watch?v=nU6FNgmmFX4

}
}//end pageLoad()

