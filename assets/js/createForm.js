import React from 'react'
import ReactDOM from 'react-dom'
import ListIngredient from './component/ListIngredient'

export class CreateForm extends React.Component{

    state = {
        listIngredient: [],
        // Store data-items parsed to JSON
        items: JSON.parse(this.props.items),
        index: 0
    };

    handleClick = (e) => {
        e.preventDefault();
        this.setState({
            listIngredient: [...this.state.listIngredient, <ListIngredient data={this.state.items} key={this.state.index} index={this.state.index}/>],
            index: this.state.index + 1
        })
    };

    render() {
        console.log(this.state.items);
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

const createFormElement = document.querySelector('#create_form');

// Retrieve data-items data as props
const getData = () => {
    const value = createFormElement.getAttribute(`data-items`);
    return value
};

const element = React.createElement(CreateForm, {
    items: getData()
});

ReactDOM.render(element, document.querySelector("div#create_form"));