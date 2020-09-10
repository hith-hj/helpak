let getupdates;
let lastscrollvalue;
var scrollValue = 0;
var files = []
getFeeds();

window.livewire.on("postCreated", function(e) {
    toastr.success("Post created");
    // setInterval(location.reload(), 3000);
    setTimeout(location.reload(), 8500)
});
window.livewire.on("postEdited", function(e) {
    toastr.info("post Updated");
});
window.livewire.on("postDeleted", function(e) {
    toastr.error("Post deleted");
});
window.livewire.on("postSaved", function(e) {
    toastr.info("Post Saved");
});
window.livewire.on("postRedo", function(e) {
    toastr.info("Post Republished");
    setTimeout(location.reload(), 50000);
});
window.livewire.on("serviceAsked", function(e) {
    toastr.info("Service Requested");
});
window.livewire.on("newNotification", function(e) {
    toastr.info("You Got a new Notification");
});
window.livewire.on("messageSent", function(e) {
    toastr.info("Your message sent");
});
window.livewire.on("userRated", function(e) {
    toastr.info("Rated successfuk");
});
window.livewire.on("NewSentMsg", function(e) {
    var aud = new Audio("../storage/app_media/send_msg.mp3")
    aud.play();
    this.scrollToDown();
});
window.livewire.on("NewRecivedMsg", function(e) {
    scrollToDown();
});
window.livewire.on("msgError", function(e) {
    toastr.error("you didnt type any thing ");
});
window.livewire.on("introder", function(e) {
    toastr.error("Where the fuck are you to go !!!!!");
});
window.livewire.on("Logout", function(e) {
    document.getElementById('logout-form').submit();
});
window.livewire.on("routeHome", function(e) {
    window.location.replace("http://127.0.0.1:8000/home");
    console.log('redirecting');
});
window.livewire.on("accountDeleted", function(e) {
    toastr.error('Whyyyyyyy !!!!')
});
window.livewire.on("upload_image", function() {
    const form = document.querySelector("#getImage");
    form.submit();
});
window.livewire.on("navUpdated", function() {
    this.clearTimeout(this.getupdates);
});
window.livewire.on("sendFund", function() {
    // this.clearTimeout(this.getupdates);
    let form = document.querySelector("#fundFormData");
    form.submit();
});
window.addEventListener('scroll', headeronscroll);

window.addEventListener('click', function() {
    this.getupdates = this.setTimeout(function() {
        window.livewire.emit("getNavUpdates");
    }, 3000)
});
window.addEventListener("mouseover", function(e) {
    if (e.target.localName == 'i') {
        e.target.classList.add('animated', 'pulse')
    }
    var tag = e.target;
    tag.addEventListener("mouseleave", function(e) {
        if (e.target.localName == 'i') {
            e.target.classList.remove('animated', 'pulse')
                // console.log();
        }
    });
});

function getFeeds() {
    const feedsDiv = document.querySelector("#scrollFeeds");
    window.addEventListener('scroll', function() {
        if (this.scrollValue > 60) {
            if (feedsDiv != null && feedsDiv.scrollTop === feedsDiv.scrollTopMax) {
                window.livewire.emit("loadNewFeeds");
                this.scrollValue = 0;
            }
        }
        this.scrollValue += 1;
        // console.log(scrollValue);
    });

}

function flash() {
    // console.log(event);
    event.target.classList.add('animated', 'flash');
    event.target.addEventListener("mouseleave", function() {
        event.target.classList.remove('animated', 'flash');
    });
}

function headeronscroll() {
    var a = document.querySelector('#msgsDiv');
    if (a != null) {
        if (lastscrollvalue == undefined) {

            lastscrollvalue = a.scrollTop;
            // console.log('undif');
        } else if (a.scrollTop > lastscrollvalue) {
            // console.log('donw');
            window.livewire.emit("msgsScrollingDown");
            lastscrollvalue = a.scrollTop;
        } else if (a.scrollTop < lastscrollvalue) {
            // console.log('up');
            window.livewire.emit("msgsScrollingUp");
            lastscrollvalue = a.scrollTop;

        }
    }
}

function displayUploadedImages(ev) {
    let gal = document.querySelector("#images_gal")
    files = ev.target.files
    var count = files.length
    if (count > 4) {
        files = []
        toastr.error('Just 4 images')
    } else {
        for (let i = 0; i < files.length; i++) {
            // console.log(files[i])
            var img = document.createElement('img')
            var itag = document.createElement('i')
            img.setAttribute('src', window.URL.createObjectURL(files[i]))
            img.setAttribute('class', 'item_image animated slideInDown')
            img.setAttribute('id', 'img_' + files[i].size)
            itag.setAttribute('id', 'rem_' + files[i].size)
            itag.setAttribute('class', 'fa fa-times remove_item animated fadeIn delay-1s')
            itag.setAttribute('onclick', 'removeImageFromUploaded(' + files[i].size + ')')
            gal.appendChild(img)
            gal.appendChild(itag)
        }
    }
}

function removeImageFromUploaded(id) {

    var del = document.querySelector('#img_' + id);
    var rem = document.querySelector('#rem_' + id);
    del.parentNode.removeChild(del)
    rem.parentNode.removeChild(rem)
}