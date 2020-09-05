function arrayRemove(arr, value) { 
    return arr.filter(function(ele){ 
        return ele != value; 
    });
}

function liveURL(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
        return '<a class="_link" href="' + url + '">' + url + '</a>';
    });
}

function youtubeVideos(text) {
    //https://www.youtube.com/embed/BxdIaUvJr1Y
    //https://www.youtube.com/watch?v=BxdIaUvJr1Y
    //<iframe width="560" height="315" src="https://www.youtube.com/embed/BxdIaUvJr1Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    //var urlRegex = /((\?v=)(\w[\w|-]*))/g;
    var urlRegex = /(https:\/\/www.youtube.com\/watch\?v=(\w[\w|-]*))/g;
    return text.replace(urlRegex, function(url) {
        return '<div class="embed-responsive embed-responsive-16by9">' + 
                    '<iframe class="embed-responsive-item" src="' + url.replace('watch?v=', 'embed/') + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' + 
                '</div>';
    });
}

function youtubeVideosActive(text) {
    var urlRegex = /(<a class="_link" href="https:\/\/www.youtube.com\/watch\?v=(\w[\w|-]*)<\/a>)/g;
    return text.replace(urlRegex, function(url) {
        url = url.replace('<a class="_link" href="', '').replace('<\/a>', '').replace('watch?v=', 'embed/')
        return '<div class="embed-responsive embed-responsive-16by9">' + 
                    '<iframe class="embed-responsive-item" src="' + url + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' + 
                '</div>';
    });
}

function bringLifeToLinks(id) {
    var element = document.getElementById(id);
    if (element)
        element.innerHTML = liveURL(element.innerHTML);
}

function bringFullLifeToLinks(id) {
    var element = document.getElementById(id);
    if (element)
    {
        element.innerHTML = youtubeVideosActive(liveURL(element.innerHTML));
    }
}