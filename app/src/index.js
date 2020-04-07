import React from 'react';
import ReactDOM from 'react-dom'
import 'bootstrap/dist/css/bootstrap.css';
import "./index.css";
import {BrowserRouter} from "react-router-dom";
import {Route, Switch} from "react-router";
import {FourOhFour} from "./pages/FourOhFour";
import {Home} from "./pages/Home";
import {SignUp} from "./pages/SignUp";
import {AboutUs} from "./pages/AboutUs";
import {FighterInfo} from "./pages/FighterInfo";
import {Favorites} from "./pages/Favorites";
import {FighterSelection} from "./pages/FighterSelection";
import {Fighters} from "./pages/Fighters";
import {SignIn} from "./pages/SignIn";
import {FighterCard} from "./shared/utils/FighterCard";
import {NavBar} from "./shared/utils/NavBar";
import {EmailValidation} from "./pages/EmailValidation";
import {ProfileSettings} from "./pages/ProfileSettings";
import {IndividualInfoCard} from "./shared/utils/IndividualInfoCard";
import { applyMiddleware, createStore } from 'redux';
import { combinedReducers } from './shared/reducers';
import thunk from 'redux-thunk';
import { Provider } from 'react-redux'
// import {httpConfig} from "./shared/utils/http-config";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faHeart} from '@fortawesome/free-solid-svg-icons'


const store = createStore(combinedReducers, applyMiddleware(thunk));

library.add(faHeart);

const Routing = (store) => (
	<>
		<Provider store={store}>
			<NavBar/>
			<BrowserRouter>
				<Switch>
					<Route exact path="/character/:characterId" component={IndividualInfoCard} characterId=":characterId"/>
					<Route exact path="/sign-in" component={SignIn}/>
					<Route exact path="/profile" component={ProfileSettings}/>
					<Route exact path="/about-us" component={AboutUs}/>
					<Route exact path="/favorites" component={Favorites}/>
					<Route exact path="/sign-up" component={SignUp}/>
					<Route exact path="/" id="home" component={Home}/>
					<Route exact path="/fighter" component={FighterInfo}/>
					<Route exact path="/fighter-selection" component={FighterSelection}/>
					<Route exact path="./shared/FighterCard" component={FighterCard}/>
					<Route exact path="/Email" component={EmailValidation}/>
					<Route exact path="/test" component={Fighters}/>
					<Route component={FourOhFour}/>
				</Switch>
			</BrowserRouter>
		</Provider>
	</>
);
ReactDOM.render(Routing(store), document.querySelector('#root'));