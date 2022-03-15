import React, { Component } from "react";
import Result from "./result";
import _ from "lodash";
import { getResults } from "../services/resultService";

class Results extends Component {
  state = {
    results: [],
  };

  componentDidMount = async () => {
    const { data: results } = await getResults();
    this.setState({ results });
  };

  handleDismissResult = (result) => {
    const results = [...this.state.results];
    _.remove(results, result);

    this.setState({ results });
  };

  handleViewResult = (result) => {};

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
