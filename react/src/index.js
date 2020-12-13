//------------- 리덕스 사용시 ----------------

import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import store from './app/store';
import { Provider } from 'react-redux';
import * as serviceWorker from './serviceWorker';


ReactDOM.render(
  <React.StrictMode>
    <Provider store={store}>
      <App />
    </Provider>
  </React.StrictMode>,
  document.getElementById('root')
);

serviceWorker.unregister();

//------------- 리덕스 사용시 ----------------

// import React from 'react';
// import ReactDOM from 'react-dom';
// // import Root from './client/Root';
// import Root from './src/App';
// import registerServiceWorker from './registerServiceWorker';
// import './index.css';
//
// ReactDOM.render(<Root />, document.getElementById('root'));
// registerServiceWorker();
