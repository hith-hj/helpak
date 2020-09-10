function showDiv() {
    var e = document.getElementById("cvResume");
    var resume = e.options[e.selectedIndex].value;
    if (resume == 1) {
        document.getElementById('cvDiv').style.display = 'block';
        document.getElementById('builderDiv').style.display = 'none';
    } else {
        document.getElementById('cvDiv').style.display = 'none';
        document.getElementById('builderDiv').style.display = 'block';
    }
}

function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function ShowHide() {
    var v = document.getElementById("opexpand").style.display;
    if (v == 'none') {
        document.getElementById("opexpand").style.display = "block";
        document.getElementById("plus").style.display = "none";
        document.getElementById("minus").style.display = "block";
    } else {
        document.getElementById("opexpand").style.display = "none";
        document.getElementById("plus").style.display = "block";
        document.getElementById("minus").style.display = "none";
    }

}

function Respons() {
    var str = location.href;
    var dest = str.split('/');
    // console.log(dest[3]);
    const mainApp = document.querySelector("#mainApp");
    const feedsNav = document.querySelector("#feedsNav");
    const homePanel = document.querySelector("#homePanel");
    const homeGadget = document.querySelector("#homeGadget");
    const publicChat = document.querySelector("#publicChat");
    const vipPost = document.querySelector("#vipPost");
    const navFooter = document.querySelector("#navFooter");
    const subChats = document.querySelector("#subChats");
    const firstNavigation = document.querySelector("#firstNavigation");
    const secondNavigation = document.querySelector("#secondNavigation");
    let profileInfoPanel = document.querySelector("#profileInfoPanel");
    const profileFeedsNav = document.querySelector("#profileFeedsNav");
    const userProfilePost = document.querySelector("#userProfilePost");
    const postPanel = document.querySelector("#postPanel");
    const centerFlow = document.querySelector("#centerFlow");
    const motoSlogan = document.querySelector("#motoSlogan");

    var wid = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if (wid >= 950) {

        mainApp.classList.remove("col-12");
        mainApp.classList.add("offset-1");
        firstNavigation.style.display = 'inherit';
        secondNavigation.style.display = 'none';
        navFooter.style.display = 'none';


        switch (dest[3]) {
            case 'home':
                homeGadget.style.display = 'block';
                homePanel.style.display = 'block';
                // vipPost.style.display = 'block';
                // publicChat.style.display = 'block';
                feedsNav.style.display = 'flex';
                motoSlogan.style.display = 'block';
                centerFlow.classList.add("offset-3");
                break;
            case 'home#':
                homeGadget.style.display = 'block';
                homePanel.style.display = 'block';
                // vipPost.style.display = 'block';
                // publicChat.style.display = 'block';
                feedsNav.style.display = 'flex';
                motoSlogan.style.display = 'block';
                centerFlow.classList.add("offset-3");
                break;
            case 'chats':
                homeGadget.style.display = 'block';
                homePanel.style.display = 'block';
                motoSlogan.style.display = 'block';
                centerFlow.classList.add("offset-3");
                break;
            case 'asks':
                homeGadget.style.display = 'block';
                homePanel.style.display = 'block';
                motoSlogan.style.display = 'block';
                centerFlow.classList.add("offset-3");
                break;
            case 'profile':
                fixedProfile = document.querySelector("#fixedProfile");
                profiel123 = document.querySelector("#profiel123");
                fixedProfile.classList.add('nav-fixed-profilePanel');
                profiel123.classList.add('row');
                profileFeedsNav.style.display = 'flex';
                profileInfoPanel = 'block';

                break;
            case 'saved':
                homePanel.style.display = "block";
                homeGadget.style.display = "block";
                // vipPost.style.display = "block";
                // publicChat.style.display = "block";
                centerFlow.classList.add("offset-3");
                break;
            case 'messages':
                homeGadget.style.display = 'block';
                subChats.style.display = "block";
                centerFlow.classList.add("offset-3");
                break;
            case 'post':
                break;
            default:
                break;
        }
    } else {
        mainApp.classList.remove("offset-1");
        mainApp.classList.add("col-12");
        firstNavigation.style.display = 'none';
        secondNavigation.style.display = 'flex';
        navFooter.style.display = 'block';

        switch (dest[3]) {
            case 'home':
                homeGadget.style.display = 'none';
                homePanel.style.display = 'none';
                // vipPost.style.display = 'none';
                // publicChat.style.display = 'none';
                feedsNav.style.display = 'flex';
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            case 'home#':
                homeGadget.style.display = 'none';
                homePanel.style.display = 'none';
                // vipPost.style.display = 'none';
                // publicChat.style.display = 'none';
                feedsNav.style.display = 'flex';
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            case 'chats':
                homeGadget.style.display = 'none';
                homePanel.style.display = 'none';
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            case 'asks':
                homeGadget.style.display = 'none';
                homePanel.style.display = 'none';
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            case 'profile':
                fixedProfile = document.querySelector("#fixedProfile");
                profiel123 = document.querySelector("#profiel123");
                fixedProfile.classList.remove('nav-fixed-profilePanel');
                profiel123.classList.remove('row');
                profileInfoPanel.style.display = 'block';
                profileFeedsNav.style.display = 'none';
                break;
            case 'saved':
                homeGadget.style.display = 'none';
                homePanel.style.display = 'none';
                // vipPost.style.display = "none";
                // publicChat.style.display = "none";
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            case 'messages':
                homeGadget.style.display = 'none';
                subChats.style.display = "none";
                centerFlow.classList.remove("offset-3");
                motoSlogan.style.display = 'none';
                break;
            case 'post':
                homePanel.style.display = 'none';
                motoSlogan.style.display = 'none';
                centerFlow.classList.remove("offset-3");
                break;
            default:
                break;
        }
    }
}

function getUrl(id, type) {
    var urlInput = document.createElement('input');
    var url = location.host + '/post/show/&' + id + '/&' + type;
    document.body.appendChild(urlInput);
    urlInput.value = url;
    urlInput.select();
    var success = document.execCommand('copy');
    document.body.removeChild(urlInput);

    console.log("true");
    toastr.success("copy done");
}

function increasView(id) {
    window.livewire.emit("increasView", id);
}

function setNav(id) {
    document.querySelector(id).classList.add("selected");
    var prev = sessionStorage.getItem('previd');
    if (prev != id && null != prev)
        document.querySelector(prev).classList.remove("selected");
    sessionStorage.setItem('previd', id);
}

window.addEventListener("resize", Respons);
window.addEventListener('hashchange', Respons);
window.addEventListener('load', function() {
    this.Respons();
    this.setTitle();
    id = sessionStorage.getItem('previd');
    if (id != null)
        document.querySelector(id).classList.add("selected");
    var Theme = sessionStorage.getItem("prevTheme");
    // this.updateTheme(Theme);
    this.activeSubNav();
});
window.addEventListener('beforeunload', function(e) {
    this.Respons();
    const theme = document.querySelector("#Theme").innerHTML;
    sessionStorage.setItem("prevTheme", theme);
});

function scrollToDown() {
    var div = document.querySelector("#msgsDiv");
    div.scrollTo({
        top: div.scrollHeight,
        behavior: 'smooth'
    });
}

function setLang(lang) {
    window.location.replace('http://127.0.0.1:8000/setLang/' + lang);
}

function activeSubNav() {
    var wid = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if (wid < 600) {
        var tap = sessionStorage.getItem('prevTap');
        document.querySelector("#" + tap).classList.add('bg-light');
    }

    // console.log(tap);

    // var tapid = sessionStorage.getItem('tapid', link);
    // if (tap !== null) {
    //     document.querySelector("#" + tap).classList.add('bg-light');
    // }
}

function setNavigate(link) {
    var tap = sessionStorage.setItem('prevTap', link);
}

function displaySecondNav() {
    var SubNav = document.querySelector("#SubNav");
    if (SubNav.style.display == 'none')
        SubNav.style.display = 'block';
    else
        SubNav.style.display = 'none';
}

function changeTheme() {
    var mod = document.querySelector("#Theme").innerHTML;
    const back = document.querySelector("body");
    if (mod == 'Night mood') {
        back.style.backgroundColor = '#2d455b';
        document.querySelector("#Theme").innerHTML = "Day mood";
    } else {
        back.style.backgroundColor = '#2090e3';
        document.querySelector("#Theme").innerHTML = "Night mood";
    }
}

function updateTheme(theme) {
    back = document.querySelector("body");
    if (theme == 'Night mood') {
        back.style.backgroundColor = '#2d455b';
        document.querySelector("#Theme").innerHTML = "Day mood";
    } else {
        back.style.backgroundColor = '#2090e3';
        document.querySelector("#Theme").innerHTML = "Night mood";
    }
}

function setTitle() {
    var title = document.querySelector("#title");
    var str = location.href;
    var dest = str.split('/');
    switch (dest[3]) {
        case 'home':
            title.innerHTML += "Home";
            break;
        case 'home#':
            title.innerHTML += "Home";
            break;
        case 'chats':
            title.innerHTML += "Chats";
            break;
        case 'asks':
            title.innerHTML += "Asks";
            break;
        case 'profile':
            title.innerHTML += "Profile";
            break;
        case 'saved':
            title.innerHTML += "Saves";
            break;
        case 'messages':
            title.innerHTML += "Message";
            break;
        case 'post':
            title.innerHTML += "Post";
            break;
        case 'setting':
            title.innerHTML += "Setting";
            break;
        case 'editProfile':
            title.innerHTML += "Edit Profile";
            break;
        case 'funding':
            title.innerHTML += "Funding";
            break;
        default:
            break;
    }
}

function faceBookShare(id) {
    var url = 'http://www.facebook.com/sharer.php?u=' +
        encodeURIComponent(location.hostname) + id;
    window.open(url, 'Share on FaceBook', 'left=20,top=20,width=550,height=400,toolbar=0,menubar=0,scrollbars=0,location=0,resizable=1');
    return false;
}