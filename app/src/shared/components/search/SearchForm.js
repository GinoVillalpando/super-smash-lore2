import React from 'react';
import Button from 'react-bootstrap/Button';

export const SearchForm = ({setSearchWord}) => {
    const setWord = (e) => {
        e.preventDefault();

        setSearchWord(e.target.value);
    };

    return(
        <>
            <input id="search-box" className="pr-5"
                    type="text"
                    placeholder="Search"
                    onChange={setWord}
                    onSubmit={setWord}
                    />
            <Button className="btn btn-primary"
                    variant="outline-dark">Go!</Button>
        </>
    )
};