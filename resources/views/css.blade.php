<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76383447-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-76383447-1');
</script>
<script>
/*! loadCSS. [c]2017 Filament Group, Inc. MIT License */
!function(a){"use strict";var b=function(b,c,d){function e(a){return h.body?a():void setTimeout(function(){e(a)})}function f(){i.addEventListener&&i.removeEventListener("load",f),i.media=d||"all"}var g,h=a.document,i=h.createElement("link");if(c)g=c;else{var j=(h.body||h.getElementsByTagName("head")[0]).childNodes;g=j[j.length-1]}var k=h.styleSheets;i.rel="stylesheet",i.href=b,i.media="only x",e(function(){g.parentNode.insertBefore(i,c?g:g.nextSibling)});var l=function(a){for(var b=i.href,c=k.length;c--;)if(k[c].href===b)return a();setTimeout(function(){l(a)})};return i.addEventListener&&i.addEventListener("load",f),i.onloadcssdefined=l,l(f),i};"undefined"!=typeof exports?exports.loadCSS=b:a.loadCSS=b}("undefined"!=typeof global?global:this);

/*! loadCSS rel=preload polyfill. [c]2017 Filament Group, Inc. MIT License */
!function(a){if(a.loadCSS){var b=loadCSS.relpreload={};if(b.support=function(){try{return a.document.createElement("link").relList.supports("preload")}catch(b){return!1}},b.poly=function(){for(var b=a.document.getElementsByTagName("link"),c=0;c<b.length;c++){var d=b[c];"preload"===d.rel&&"style"===d.getAttribute("as")&&(a.loadCSS(d.href,d,d.getAttribute("media")),d.rel=null)}},!b.support()){b.poly();var c=a.setInterval(b.poly,300);a.addEventListener&&a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}),a.attachEvent&&a.attachEvent("onload",function(){a.clearInterval(c)})}}}(this);
</script>
<link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"></noscript>
<link rel='dns-prefetch' href='//cdn.islamic.network' />
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
@font-face {
    font-family: fontArab;
    src: url('{{ asset('inc/fonts/LPMQ.ttf') }}');
    font-display: swap;
}
body {
    font-family: 'Quicksand', sans-serif;
    background: #fafafa;
}
h1, h2, h3, h4{font-size: 1.7em;text-transform: capitalize;}
p {
    font-family: 'Quicksand', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
}
a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}
#st-2 {
    bottom: 0px !important;
    top: auto !Important;
}
.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 20px 0;
}
.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
    perspective: 1500px;
}
#sidebar {
    min-width: 250px;
    max-width: 250px;
    color: #1e3d73;
    box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
    transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
    transform-origin: bottom left;
}
#sidebar.active {
    margin-left: -250px;
    transform: rotateY(100deg);
}
.post{
    min-height: 100vh;    
}
#sidebar ul p {
    color: #1e3d73;
    padding: 10px;
}

#sidebar ul li a {
    padding: 13px 10px;
    font-size: 1.1em;
    display: block;
    box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
}
#sidebar ul li a:hover {
    color: #1c4a13;
    background: #fff;
}
#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #1e3d73;
}
a[data-toggle="collapse"] {
    position: relative;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
ul ul a {
    padding: 10px !important;
    font-size: 0.9em !important;
    padding-left: 30px !important;
}
ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}
a.download {
    background: #fff;
    color: #7386D5;
}
a.article, a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}
#content {
    width: 100%;
    min-height: 100vh;
    transition: all 0.3s;
}
.post {
    padding: 20px;
    color: #666;
}
#sidebarCollapse {
    width: 40px;
    height: 40px;
    background: #f5f5f5;
    cursor: pointer;
    font-size: 25px;
}
#sidebarCollapse span {
    width: 80%;
    height: 2px;
    margin: 0 auto;
    display: block;
    background: #555;
    transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
    transition-delay: 0.2s;
}
#sidebarCollapse span:first-of-type {
    transform: rotate(45deg) translate(2px, 2px);
}
#sidebarCollapse span:nth-of-type(2) {
    opacity: 0;
}
#sidebarCollapse span:last-of-type {
    transform: rotate(-45deg) translate(1px, -1px);
}
.list-group {
    display: block;
}
.column-2{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}
#sidebarCollapse.active span {
    transform: none;
    opacity: 1;
    margin: 5px auto;
}
.arab {
    font-family: fontArab;
    font-weight: 400;
    font-size: 1.5rem;
    direction: rtl;
}
h1, h2, h3, h4, h5, a, .ayah-playing, .home li a, .btn-link {
    color: #1e3d73;
}
.column-2{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}
.column-3{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}
ul.column-2 li.list-group-item, ul.column-3 li.list-group-item, ul.home li.list-group-item{
    border: none;
}
ul.home li.list-group-item{
    font-weight: 400;
}
.navbar-brand {
    margin: auto;
} 
.table td, .table th {
    padding: 5px;
}
.halaman{
    border: 100px solid transparent;
    padding: 15px;
    border-image: url({{ asset('inc/images/brdr.jpg') }}) 22% round;
}
@media only screen and (max-width: 600px) {
    .halaman{
        border: 30px solid transparent;
        padding: 5px;
        border-image: url({{ asset('inc/images/brdr.jpg') }}) 22% round;
    }
    .arab {
        font-size: 1.3em;
    }
}
</style>