import React, { Component } from "react";
import Job from "./job";

class Jobs extends Component {
  state = {};
  render() {
    return (
      <div className="grid grid-cols-2 grid-flow-rows gap-8">
        <Job>Job 1</Job>
        <Job>Job 2</Job>
        <Job>Job 3</Job>
        <Job>Job 4</Job>
        <Job>Job 5</Job>
        <Job>Job 6</Job>
        <Job>Job 7</Job>
      </div>
    );
  }
}

export default Jobs;
