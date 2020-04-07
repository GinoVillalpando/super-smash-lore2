import React, {useState} from "react";
import Row from "react-bootstrap/Row";
import Container from 'react-bootstrap/Container';
import "../index.css";
import {Fighters} from "../pages/Fighters";
import {SearchForm} from "../shared/components/search/SearchForm";
import Col from "react-bootstrap/Col";


export const FighterSelection = () => {
	
	const [searchWord, setSearchWord] = useState('');


	return (
		<>
			<div id="fighterBody">
				<main className="my-5">
					<Container fluid="true" className="container-fluid text-center text-md-center">
						<Row>
							<h2 className="text-lg-left col-lg-9"><strong>CHOOSE YOUR FIGHTER:</strong></h2>
							{/*search bar is below*/}
								<Col>
									<SearchForm searchWord={searchWord} setSearchWord={setSearchWord}/>
								</Col>
							</Row>
						<Row>
							<Fighters searchWord={searchWord}/>
						</Row>
					</Container>
				</main>
			</div>
		</>
	)
};