import React from 'react'

export default class ListIngredient extends React.Component{
    constructor(props){
        super(props)
    }
    render() {
        return(
            <div className="row">
                <input type="text" className="form-control col-md-6" name={`ingredient${this.props.index}`}/>
                <input type="text" className="form-control col-md-4 offset-md-1" name={`quantity${this.props.index}`}/>
            </div>
        )
    }
}
