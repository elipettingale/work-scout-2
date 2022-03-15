import React, { Component } from "react";
import Result from "./result";
import _ from "lodash";
import { dismissResult, getResults } from "../services/resultService";

class Results extends Component {
  state = {
    results: [],
  };

  componentDidMount = async () => {
    const { data: results } = await getResults();
    this.setState({ results });
  };

  handleDismissResult = async (result) => {
    const previousResults = [...this.state.results];

    const results = [...this.state.results];
    _.remove(results, result);
    this.setState({ results });

    try {
      await dismissResult(result);
    } catch (ex) {
      this.setState({ results: previousResults });
    }
  };

  handleViewResult = (result) => {
    // todo: init then open modal
  };

  render() {
    return (
      <div className="grid grid-cols-2 grid-flow-rows gap-8">
        {this.state.results.map((result) => (
          <Result key={result.id} data={result}>
            <button
              className="button flex-1 mr-2"
              onClick={() => this.handleDismissResult(result)}
            >
              Dismiss
            </button>
            <button
              className="button flex-1 is-pink"
              onClick={() => this.handleViewResult(result)}
            >
              View
            </button>
          </Result>
        ))}
      </div>
    );
  }
}

export default Results;
