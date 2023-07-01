import ArticleList from '../components/Article'
import React, { useState, useEffect } from "react";
import ArticleService from '../services/ArticleService'
import ReactPaginate from 'react-paginate'
import LoadingSpinner from '../components/LoadingSpinner';

function Items({currentItems }) {
    return (
        <div>
        
            {/* {search && search.map((article, index) => (
                <ArticleList
                    key={`${article.title}-${index}`}
                    title={article.title}
                    price={article.price}
                    detail={article.detail}
                />
            ))} */}
            {currentItems && currentItems.map((article, index) => (
                <ArticleList
                    key={`${article.title}-${index}`}
                    title={article.title}
                    price={article.price}
                    detail={article.detail}
                />
            ))}
        </div>
    );
}



export default function () {
    const [isLoading, setIsLoading] = useState(false);
    const [errorMessage, setErrorMessage] = useState("");
    const [articles, setArticles] = useState([]);
    const [searchText, setSearchText] = useState("")
    useEffect(() => {
        retrieveTutorials();
    }, []);
    const retrieveTutorials = () => {
        setIsLoading(true)
        ArticleService.getAll()
            .then(response => {
                setArticles(response.data['hydra:member']);
                console.log(response.data);
                setIsLoading(false)
            })
            .catch(e => {
                console.log(e);
                setErrorMessage("Unable to fetch user list");
                setIsLoading(false)
            });
    };

    //Pagination
    const [itemOffset, setItemOffset] = useState(0);

    // Simulate fetching items from another resources.
    // (This could be items from props; or items loaded in a local state
    // from an API endpoint with useEffect and useState)
    const itemsPerPage = 2;
    let endOffset = itemOffset + itemsPerPage;
    console.log(`Loading items from ${itemOffset} to ${endOffset}`);
    let currentItems = articles.slice(itemOffset, endOffset);
    let pageCount = Math.ceil(articles.length / itemsPerPage);
    

    // Invoke when user click to request another page.
    let handlePageClick = (event) => {
        let newOffset = (event.selected * itemsPerPage) % articles.length;
        console.log(
            `User requested page number ${event.selected}, which is offset ${newOffset}`
        );
        setItemOffset(newOffset);
    };

    let inputSearchHandler = (e) => {
        //convert input text to lower case
        var lowerCase = e.target.value.toLowerCase();
        setSearchText(lowerCase);
    };

    function List(props) {        
        //create a new array by filtering the original array
        const filteredData = articles.filter((article) => {
            //if no input the return the original
            if (props.input === '') {
                return articles;
            }
            //return the item which contains the user input
            else {
                return article.title.toLowerCase().includes(props.input)
            }
        })
        currentItems = filteredData.slice(itemOffset, endOffset);
        pageCount = Math.ceil(filteredData.length / itemsPerPage);
        // console.log(filteredData);
        return (
            <div>
                {isLoading ? <LoadingSpinner /> : <Items currentItems={currentItems} />}
                <nav aria-label="Page navigation">
                    <ReactPaginate
                        activeClassName="active"
                        breakLabel="..."
                        nextLabel="next >"
                        nextClassName="page-item"
                        previousClassName="page-item"
                        nextLinkClassName="page-link"
                        previousLinkClassName="page-link"
                        containerClassName="pagination"
                        pageClassName="page-item"
                        pageLinkClassName="page-link"
                        onPageChange={handlePageClick}
                        pageRangeDisplayed={5}
                        pageCount={pageCount}
                        previousLabel="< previous"
                        renderOnZeroPageCount={null}
                    />
                </nav>
            </div>

        )
    }
    return (
        <div>
            <h3>Boutique</h3>
            <input className='form-control' value={searchText} onChange={inputSearchHandler} />
            <div className="container d-flex justify-content-center mt-50 mb-50">

                <div className="row">
                    <div className="col-md-10">
                        {errorMessage && <div className="error">{errorMessage}</div>}
                        <List input={searchText}/>

                    </div>
                </div>
            </div>
        </div>
    )
}