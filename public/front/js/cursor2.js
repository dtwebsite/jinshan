//$(function() {  

    "use strict";

    var o = ((a.prototype, [{
        key: "init",
        value: function() {
            var e = this;
            this.gsap = r.a.to({}, .016, {
                repeat: -1,
                onRepeat: function() {
                    e.posX += (e.mouseX - e.posX) / e.delay,
                    e.posY += (e.mouseY - e.posY) / e.delay,
                    r.a.set(e.follower, {
                        css: {
                            transform: "translate(" + e.posX + "px," + e.posY + "px)"
                        }
                    })
                }
            }),
            document.addEventListener("mousemove", e.mouseMove.bind(this)),
            this.linkEvent()
        }
    }, {
        key: "mouseMove",
        value: function(e) {
            this.mouseX = e.clientX,
            this.mouseY = e.clientY
        }
    }, {
        key: "linkEvent",
        value: function() {
            var e = this;
            this.link = document.querySelectorAll("a, button, label");
            for (var t = 0; t < this.link.length; ++t)
                this.link[t].addEventListener("mouseenter", function() {
                    e.enterTrigger()
                }),
                this.link[t].addEventListener("mouseleave", function() {
                    e.leaveTrigger()
                })
        }
    }, {
        key: "enterTrigger",
        value: function() {
            this.follower.classList.add("is-bounce-in"),
            this.timer && clearTimeout(this.timer)
        }
    }, {
        key: "leaveTrigger",
        value: function() {
            var e = this;
            this.timer = setTimeout(function() {
                e.follower.classList.remove("is-bounce-in"),
                e.leaveSet()
            }, 200)
        }
    }, {
        key: "leaveSet",
        value: function() {
            var e = this;
            this.follower.classList.add("is-bounce-out"),
            setTimeout(function() {
                e.follower.classList.remove("is-bounce-out")
            }, 1200)
        }
    }, {
        key: "destroy",
        value: function() {
            this.gsap && this.gsap.kill()
        }
    }]),
    a);
    function a() {
        !function(e) {
            if (!(e instanceof a))
                throw new TypeError("Cannot call a class as a function")
        }(this),
        this.body = document.querySelector("body"),
        this.posX = 0,
        this.posY = 0,
        this.mouseX = 0,
        this.mouseY = 0,
        this.delay = 10,
        this.timer = null,
        this.gsap = null,
        this.follower = document.createElement("div"),
        this.followerInner = document.createElement("span"),
        this.follower.id = "js-follower",
        this.follower.classList.add("follower"),
        this.follower.appendChild(this.followerInner),
        this.body.appendChild(this.follower)
    }
