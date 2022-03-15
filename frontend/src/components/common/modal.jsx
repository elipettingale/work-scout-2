import React, { Component } from "react";

class Modal extends Component {
  state = {};
  render() {
    return <div className="modal">{this.props.children}</div>;
  }
}

export default Modal;
