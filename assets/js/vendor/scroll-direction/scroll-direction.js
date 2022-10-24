export default class ScrollDirection {
  constructor(params = {}) {
    // override default settings
    this.settings = Object.assign(
      {
        classContainer: document.body,
        scrollElement: window,
        scrollDownClass: "scroll-down",
        scrollUpClass: "scroll-up",
        scrollTopClass: "scroll-top",
        scrollBottomClass: "scroll-bottom"
      },
      params
    );

    // setup inital vars
    this.container = this.settings.classContainer;
    this.root = this.settings.scrollElement;
    this.prev = this.getScroll(this.root);
    console.log(this.root, this.prev);

    // scroll event
    this.root.addEventListener("scroll", () => this.update());

    // init update
    this.update();
  }

  update() {
    console.log("scroll");

    // get scroll position
    let scroll = this.getScroll(this.root);

    // reset classes
    this.container.classList.remove(
      this.settings.scrollUpClass,
      this.settings.scrollDownClass
    );

    // determine the scroll direction and add classes accordingly
    if (this.prev > scroll) {
      this.container.classList.add(this.settings.scrollUpClass);
    } else if (this.prev < scroll) {
      this.container.classList.add(this.settings.scrollDownClass);
    }

    if (scroll == 0) {
      this.container.classList.add(this.settings.scrollTopClass);
    } else {
      this.container.classList.remove(this.settings.scrollTopClass);
    }

    if (
      this.root.offsetHeight + this.root.scrollTop >=
      this.root.scrollHeight - 1
    ) {
      this.container.classList.add(this.settings.scrollBottomClass);
    } else {
      this.container.classList.remove(this.settings.scrollBottomClass);
    }

    // save the previous scroll
    this.prev = scroll;
  }

  // get the scroll position of the root element.
  // Chooses between scrollY for the window and scrollTop for HTMLElements
  getScroll(e) {
    return e instanceof Window ? e.scrollY : e.scrollTop;
  }
}
