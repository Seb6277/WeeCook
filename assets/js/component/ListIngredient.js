/*
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

import React from 'react'

export default class ListIngredient extends React.Component{
    constructor(props){
        super(props)
    }

    render() {
        return(
            <div className="row">
                <select type="select" className="form-control col-md-6" name={`ingredient${this.props.index}`}>
                    {this.props.data.map((item) => <option value={item.name}>{item.name}</option>)}
                </select>
                <input type="text" className="form-control col-md-4 offset-md-1" name={`quantity${this.props.index}`}/>
            </div>
        )
    }
}
