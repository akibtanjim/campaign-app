import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import ListItem from "./components/ListItem";
import Swal from "sweetalert2";

const List = () => {
    const [campaigns, setCampaigns] = useState([]);
    const [loading, setLoading] = useState(false);
    const getCampaigns = () => {
        setLoading(true);
        axios
            .get("/api/v1/campaigns")
            .then((response) => {
                setLoading(false);
                setCampaigns(response?.data?.data || []);
            })
            .catch((error) => {
                setLoading(false);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text:
                        error?.response?.data?.message ||
                        "Something went wrong!",
                });
            });
    };
    useEffect(() => {
        getCampaigns();
    }, []);
    return (
        <>
            {loading && (
                <div className="d-flex justify-content-center my-10">
                    <div
                        className="spinner-border text-info"
                        style={{ width: "3rem", height: "3rem" }}
                        role="status"
                    >
                        <span className="visually-hidden">Loading...</span>
                    </div>
                </div>
            )}
            {!loading && (
                <>
                    <div className="table-responsive">
                        <table className="table table-secondary table-bordered table-striped table-hover">
                            <thead>
                                <tr className="text-dark text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">From Date</th>
                                    <th scope="col">To Date</th>
                                    <th scope="col">Total Budget</th>
                                    <th scope="col">Daily Budget</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {campaigns.length > 0 &&
                                    campaigns.map((campaign) => (
                                        <ListItem
                                            key={campaign.id}
                                            campaign={campaign}
                                        ></ListItem>
                                    ))}
                                {campaigns?.length === 0 && (
                                    <tr>
                                        <td colSpan="7" className="text-center">
                                            <p className="fs-3 fw-bold">
                                                No Campaigns Found
                                            </p>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </>
            )}
        </>
    );
};

export default List;

if (document.getElementById("campaigns")) {
    ReactDOM.render(<List />, document.getElementById("campaigns"));
}
