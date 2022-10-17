export default class StripeEffect {
  constructor(elements, settings) {
    let defaultSettings = {
      time: 500,
      outDelay: 0,
      class: "has-stripe",
      inverted: false,
    }
    settings = Object.assign(defaultSettings, settings);
    if (typeof elements === "string") {
      this.elements = document.querySelectorAll(elements);
    } else if (elements instanceof HTMLElement) {
      this.elements = [elements];
    } else if (elements instanceof NodeList) {
      this.elements = elements;
    }
    this.effects = {};
    let index = 0;
    this.time = settings["time"];
    this.outDelay = settings["outDelay"];
    this.class = settings.class;
    this.inverted = settings.inverted;
    console.log(this.elements);
    for (let element of this.elements) {
      element.classList.add(this.class);
      element.dataset.effectIndex = index;
      if (!this.inverted) {
        element.addEventListener("mouseenter", e => this.enter(element));
        element.addEventListener("mouseleave", e => this.leave(element));
      } else {
        element.addEventListener("mouseenter", e => this.leave(element));
        element.addEventListener("mouseleave", e => this.enter(element));
      }
      index++;

      if (this.inverted) {
        this.enter(element);
      }

    }
  }

  enter(element) {
    let span = document.createElement("span");
    span.classList.add("effect");
    span.style.transitionDuration = this.time / 1000 + "s";
    element.appendChild(span);
    this.effects[element.dataset.effectIndex] = span;
    setTimeout(e => {
      span.classList.add("animate-in");
    }, 10);
  }

  leave(element) {
    let index = element.dataset.effectIndex;
    if (index in this.effects) {
      let span = this.effects[index];
      setTimeout(e => {
        span.classList.add("animate-out");
      }, this.outDelay);
      setTimeout(e => {
        span.parentNode.removeChild(span);
      }, this.time + this.outDelay);
    }
  }
}
