import React, { Component } from "react";
import Job from "./job";
import _ from "lodash";

class Jobs extends Component {
  state = {
    jobs: [
      {
        id: 1,
        title: "React Developer",
        rating: 10,
        info: {
          rate: "£300 - £400",
          length: "6 Months",
          ir35: "Outside",
          remote: "Yes",
        },
      },
      {
        id: 2,
        title: "Contract PHP Developer",
        rating: 7.5,
        info: {
          rate: "£300 - £400",
          length: "6 Months",
          ir35: "Inside",
          remote: "Yes",
        },
      },
      {
        id: 3,
        title: "Senior Laravel Developer",
        rating: 2,
        info: {
          rate: "£200 - £300",
          length: "3 Months",
          ir35: "Inside",
          remote: "No",
        },
      },
    ],
  };

  handleDismissJob = (job) => {
    const jobs = [...this.state.jobs];
    _.remove(jobs, job);

    this.setState({ jobs });
  };

  handleViewJob = (job) => {};

  render() {
    return (
      <div className="grid grid-cols-2 grid-flow-rows gap-8">
        {this.state.jobs.map((job) => (
          <Job key={job.id} data={job}>
            <button
              className="button flex-1 mr-2"
              onClick={() => this.handleDismissJob(job)}
            >
              Dismiss
            </button>
            <button
              className="button flex-1 is-pink"
              onClick={() => this.handleViewJob(job)}
            >
              View
            </button>
          </Job>
        ))}
      </div>
    );
  }
}

export default Jobs;
