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
    const activeResult = this.state.results[0];
    console.log(activeResult);

    return (
      <div className="flex">
        <div className="flex-1 h-screen p-8 overflow-scroll results">
          {this.state.results.map((result) => (
            <Result key={result.id} data={result}></Result>
          ))}
        </div>
        <div className="flex-1 bg-white h-screen p-8 overflow-scroll">
          {this.renderPane()}
        </div>
      </div>
    );
  }

  renderPane() {
    const result = this.state.results[0];
    if (typeof result === "undefined") return;

    return (
      <Result key={result.id} data={result}>
        <div className="flex mt-8">
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
        </div>
        <div className="mt-8">{result.description}</div>
      </Result>
    );
  }
}

export default Results;
