import React from 'react'
import ReactDOM from 'react-dom'
import ListIngredient from './component/ListIngredient'

export class CreateForm extends React.Component{

    state = {
        listIngredient: [],
        index: 0
    };

    handleClick = (e) => {
        e.preventDefault();
        this.setState({
            listIngredient: [...this.state.listIngredient, <ListIngredient key={this.state.index} index={this.state.index}/>],
            index: this.state.index + 1
        })
    };

    render() {
        return(
            <div className="row">
                <div className="col-md-12">
                    {this.state.listIngredient.map((ingredient) => ingredient)}
                </div>
                <button className="btn btn-primary col-md4 offset-md-4" onClick={this.handleClick}>
                    Ajouter un ingrédient
                </button>
            </div>
        )
    }
}

ReactDOM.render(React.createElement(CreateForm), document.querySelector("div#create_form"));