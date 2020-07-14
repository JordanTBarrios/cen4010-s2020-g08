//grab article button
document.getElementById("articleDataButton").addEventListener('click', findArticle);

function findArticle(data){
    var url = 'https://gnews.io/api/v3/search?q=covid&token=d2d2bf8812fe8a0c1e55049d328923a6';

    var req = new Request(url);

    fetch(req)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        
        //display article info in this div
        var display = document.getElementById("articleResult");
        display.innerHTML = display.innerHTML + "Article Count: " + data.articleCount;
        for (var i = 0; i < 3; i++){
            
            display.innerHTML = display.innerHTML +
            "<br>Title: " + data.articles[i].title +
            "<br>Description: " + data.articles[i].description +
            "<br>Image: <img src=\"" + data.articles[i].image + "\">" +
            "<br>Original Link: " + data.articles[i].url + "<br>";
        }
    });
}