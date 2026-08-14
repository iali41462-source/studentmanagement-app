import React, { useEffect, useState ,useRef, useMemo, useCallback,useReducer} from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import UserContext from "./components/UserContext";
import StudentTable from './components/StudentTable';
import useStudents from "./hooks/useStudents";


function App() {
        //useref for search input
    const searchInputRef = useRef(null);
     // Pagination information
    const [pagination, setPagination] = useState({
        current_page: 1,
        last_page: 1,
        total: 0
    });
      // Current page
    const [page, setPage] = useState(1);
        // Sort order
    const [order, setOrder] = useState('asc');
      // Sort field
    const [sort, setSort] = useState('id');
       // Search input
    const [search, setSearch] = useState('');
      //useState for search input debouncing
    const [debouncedSearch, setDebouncedSearch] = useState(search);

    const { state, dispatch ,fetchStudents} = useStudents(debouncedSearch,
    sort,
    order,
    page,
    setPagination,
    searchInputRef);

        //usememo for count student
const filteredStudents = useMemo(() => {

    return state.students.filter(student =>
        student.name.toLowerCase().includes(search.toLowerCase())
    );

}, [state.students, search]);



    //useref for change value without re-rendering
    const renderCount = useRef(0);

    renderCount.current = renderCount.current + 1;
    console.log("Render Count:", renderCount.current);

    // Jab search, sort, order ya page change hoga
    // API dobara call hogi
    useEffect(() => {

    const timer = setTimeout(() => {
        setDebouncedSearch(search);
    }, 500); // 1 second delay

    return () => {
        clearTimeout(timer);
    };

}, [search]);
    useEffect(() => {
        const controller = new AbortController();


        fetchStudents(controller.signal);
        return () => {
            controller.abort();

        };

    }, [debouncedSearch, sort, order, page]);


    // Search change hone par page 1 par wapas
    const handleSearchChange = (e) => {

        setSearch(e.target.value);
        setPage(1);

    };


    // Sort field change
    const handleSortChange = (e) => {

        setSort(e.target.value);
        setPage(1);

    };


    // Order change
    const handleOrderChange = (e) => {

        setOrder(e.target.value);
        setPage(1);

    };


    // Previous page
    const previousPage = () => {

        if (pagination.current_page > 1) {

            setPage(pagination.current_page - 1);

        }

    };


    // Next page
    const nextPage = () => {

        if (pagination.current_page < pagination.last_page) {

            setPage(pagination.current_page + 1);

        }

    };
const handleStudentClick = useCallback((student) => {

    console.log("Student Child se Parent ko:", student);

}, []);
    return (

        <div className="container mt-4">

            <h1 className="mb-4">
                Students
            </h1>


            {/* Search + Sorting */}

            <div className="card shadow mb-4">

                <div className="card-body">

                    <div className="row g-3">


                        {/* Search */}

                        <div className="col-md-5">

                            <label className="form-label">
                                Search Student
                            </label>

                            <input
                                ref={searchInputRef}
                                type="text"
                                className="form-control"
                                placeholder="Search by name, email, address or mobile..."
                                value={search}
                                onChange={handleSearchChange}
                            />
                            <button
                            className="btn btn-secondary mt-2"
                            onClick={() => searchInputRef.current.focus()}
                            >
                            Focus Search
                            </button>

                        </div>


                        {/* Sort Field */}

                        <div className="col-md-3">

                            <label className="form-label">
                                Sort By
                            </label>

                            <select
                                className="form-select"
                                value={sort}
                                onChange={handleSortChange}
                            >

                                <option value="id">
                                    ID
                                </option>

                                <option value="name">
                                    Name
                                </option>

                                <option value="email">
                                    Email
                                </option>

                                <option value="created_at">
                                    Created At
                                </option>

                            </select>

                        </div>


                        {/* Order */}

                        <div className="col-md-2">

                            <label className="form-label">
                                Order
                            </label>

                            <select
                                className="form-select"
                                value={order}
                                onChange={handleOrderChange}
                            >

                                <option value="asc">
                                    Ascending
                                </option>

                                <option value="desc">
                                    Descending
                                </option>

                            </select>

                        </div>


                        {/* Total */}

                        <div className="col-md-2">

                            <label className="form-label">
                                Total
                            </label>

                            <div className="form-control">
                                {pagination.total}
                                {/* {  totalStudents} */}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {/* Error */}

            {state.error && (

                <div className="alert alert-danger">
                    {state.error}
                </div>

            )}


            {/* Loading */}

            {state.loading &&(

                <div className="alert alert-info">
                    Students loading...
                </div>

            )}


            {/* Table */}

            {!state.loading && !state.error && (

                <div className="card shadow">

                    <div className="card-header">

                        <h4 className="mb-0">
                            Student List
                        </h4>

                    </div>


                    <div className="card-body">

                        <div className="table-responsive">

<UserContext.Provider value={state.students}>
     <StudentTable

    onStudentClick={handleStudentClick}
/>
</UserContext.Provider>





                        </div>


                        {/* Pagination */}

                        <div className="d-flex justify-content-between align-items-center mt-3">

                            <button
                                className="btn btn-primary"
                                onClick={previousPage}
                                disabled={pagination.current_page === 1}
                            >
                                Previous
                            </button>


                            <span>

                                Page {pagination.current_page}
                                {' '}
                                of
                                {' '}
                                {pagination.last_page}

                            </span>


                            <button
                                className="btn btn-primary"
                                onClick={nextPage}
                                disabled={
                                    pagination.current_page ===
                                    pagination.last_page
                                }
                            > 03460697069
                                Next
                            </button>

                        </div>

                    </div>

                </div>

            )}

        </div>

    );

}


createRoot(
    document.getElementById('react-app')
).render(
    <App />
);
