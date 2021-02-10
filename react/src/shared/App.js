import React, { Component } from 'react';
import { Route, Switch } from 'react-router-dom';
import { Home, About, Menu } from '../pages';




class App extends Component {
    render() {
        return (          
            <div>
              <Menu></Menu>
              <div>
                  <Route exact path="/" component={Home}/>
                  <Switch>
                      <Route path="/about/:name" component={About}/>
                      <Route path="/about" component={About}/>
                  </Switch>

              </div>
            </div>

        );
    }
}

export default App;
