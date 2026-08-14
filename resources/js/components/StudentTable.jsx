import React from 'react';
import { useContext } from 'react';
import UserContext from "./UserContext";

const StudentTable = React.memo(function StudentTable({ onStudentClick  }) {
const students= useContext(UserContext);
console.log("StudentTable Render");
    return (


 <table className="table table-bordered table-striped table-hover">

                                <thead>

                                    <tr>

                                        <th>
#
                                        </th>

                                        <th>
                                            Name
                                        </th>

                                        <th>
                                            Email
                                        </th>

                                        <th>
                                            Mobile
                                        </th>

                                        <th>
                                            Address
                                        </th>

                                        <th>
                                            Created At
                                        </th>
                                        <th>Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    {students.length > 0 ? (

                                        students.map((student, index) => (

                                            <tr key={student.id}>


                                                <td>
                                                    {index + 1}
                                                </td>

                                                <td>
                                                    {student.name}
                                                </td>

                                                <td>
                                                    {student.email}
                                                </td>

                                                <td>
                                                    {student.mobile}
                                                </td>

                                                <td>
                                                    {student.address}
                                                </td>

                                                <td>
                                                    {student.created_at}
                                                </td>
                                                 <td>
        <button
            className="btn btn-primary"
            onClick={() => onStudentClick(student)}
        >
            Select
        </button>
    </td>

                                            </tr>

                                        ))

                                    ) : (

                                        <tr>

                                            <td
                                                colSpan="7"
                                                className="text-center"
                                            >
                                                No students found.
                                            </td>

                                        </tr>

                                    )}

                                </tbody>

                            </table>
    );
});

export default StudentTable;
