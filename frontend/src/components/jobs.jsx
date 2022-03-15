import React, { Component } from "react";
import Job from "./job";
import _ from "lodash";
import { getJobs } from "../services/jobService";

class Jobs extends Component {
  state = {
    jobs: [],
  };

  componentDidMount = async () => {
    const { data: jobs } = await getJobs();
    this.setState({ jobs });
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
