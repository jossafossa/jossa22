export default class ScrollSnap {
  constructor(element, settings) {
    let defaultSettings = {
      offset: 0,
      scrollContainer: window
    }
    settings = Object.assign(defaultSettings, settings);
    console.log(settings);
    this.element = element;
    this.scrollContainer = settings.scrollContainer;
    this.relY = this.getScroll();
    this.prevScroll = 0;
    this.closed = false;
    this.opened = false;
    this.isSticky = false;


    this.scrollContainer.addEventListener("scroll", e => {
      let box = this.element.getBoundingClientRect();
      let scroll = this.getScroll();
      let down = this.prevScroll < scroll;
      // if (down) {




      if (this.relY - scroll + box.height < 0) {
        this.close();
        this.relY = scroll - box.height;
      } else if (this.relY - scroll > 0) {
        this.open();
        this.relY = scroll;
      } else {
        this.stick();
      }
      // this.stick();
      // } else {
      //   if (this.relY - scroll > 0) {
      //     this.open();
      //     this.relY = scroll;
      //   } else {
      //     this.stick();
      //   }
      // }
      this.prevScroll = scroll;
    })

    this.open();

  }

  getScroll() {
    if (this.scrollContainer instanceof Window) return this.scrollContainer.scrollY;
    return this.scrollContainer.scrollTop;
  }

  stick() {
    if (!this.isSticky) {
      this.element.style.position = "absolute";
      this.element.style.transform = `translateY(calc(${this.relY}px))`;
      this.isSticky = true;
      console.log("stuck");
    }

  }

  unstick() {
    // console.log("fix");
    this.isSticky = false;

    this.element.style.position = "fixed";
  }

  open() {
    if (!this.isOpened || this.isSticky) {
      this.unstick();
      this.element.style.transform = `translateY(0)`;
      this.isOpened = true;
      console.log("opened");
    }

  }

  close() {
    if (this.isOpened || this.isSticky) {
      this.unstick();
      this.element.style.transform = `translateY(-100%)`;
      this.isOpened = false;
      console.log("closed");
    }
  }



}
