import { useEffect, useState, useReducer } from "react";
import axios from "axios";

function studentReducer(state, action) {

    if (action.type === 'loading') {
        return {
            ...state,
            loading: true,
            error: null
        };
    }

    if (action.type === 'success') {
        return {
            ...state,
            loading: false,
            students: action.students,
            error: null
        };
    }

    if (action.type === 'error') {
        return {
            ...state,
            loading: false,
            error: action.message
        };
    }

    return state;
}
function useStudents(debouncedSearch,
    sort,
    order,
    page,
    setPagination,
    searchInputRef) {

    const [state, dispatch] = useReducer(studentReducer, {
        students: [],
        loading: true,
        error: null
    });


       // Students API se fetch karna
        const fetchStudents = (signal) => {


           dispatch({
        type: 'loading'
    });

            axios.get('/api/v2/students', {

                params: {
                    search: debouncedSearch,
                    sort: sort,
                    order: order,
                    page: page
                },
                signal: signal

            })
            .then(response => {

        dispatch({
        type: 'success',
        students: response.data.students.data
    });

        setPagination({
            current_page: response.data.students.current_page,
            last_page: response.data.students.last_page,
            total: response.data.students.total
        });
         searchInputRef.current.focus();


    })
            .catch(error => {

                console.log(
                    'STUDENTS ERROR:',
                    error.response?.data
                );

                dispatch({
        type: 'error',
        message:
            error.response?.data?.message ||
            'Students load nahi ho sake.'
    });

            })

        };
        return {
        state,
        dispatch,
        fetchStudents
    };
}

export default useStudents;
