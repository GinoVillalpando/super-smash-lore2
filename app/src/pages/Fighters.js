import {useSelector, useDispatch} from "react-redux";
import React, {useEffect} from 'react';
import {getAllCharacters} from "../shared/actions/character-action";
import {FighterCard} from "../shared/utils/FighterCard";

export const Fighters = ({searchWord}) => {
       
    const fighterState = useSelector(state => (state.characters ? state.characters : []));

    const filteredFighters = fighterState.filter(character => character.characterName.toLowerCase().includes(searchWord));

    console.log(filteredFighters);

    const characters = filteredFighters, dispatch = useDispatch();

    function sideEffects() {
        dispatch(getAllCharacters());
    }

    const sideEffectsInputs = [];

    useEffect(sideEffects, sideEffectsInputs);

    return (
        <>
            {characters.map(character => <FighterCard character={character}/>
            )}
        </>
    )
};