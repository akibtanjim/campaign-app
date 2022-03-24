import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Swal from "sweetalert2";

//custom components
import Input from "../common/Input";
import DateInput from "../common/DateInput";
import NumberInput from "../common/NumberInput";
import FileInput from "../common/FileInput";
import CreativesItem from "./components/Creatives";

//utils
import { prepareCampaignFormData } from "../../utils";

const Edit = ({ id }) => {
    const [fileCount, setFileCount] = useState(1);
    const [errors, setErrors] = useState([]);
    const [errorMessage, setErrorMessage] = useState(null);
    const [name, setName] = useState("");
    const [fromDate, setFromDate] = useState("");
    const [toDate, setToDate] = useState("");
    const [totalBudget, setTotalBudget] = useState("");
    const [dailyBudget, setDailyBudget] = useState("");
    const [creativeUploads, setCreativeUploads] = useState([]);
    const [creatives, setCreatives] = useState([]);
    const [fetchingCampaign, setFetchingCampaign] = useState(false);
    const [loading, setLoading] = useState(false);
    const [campaignFetchingFailed, setCampaignFetchingFailed] = useState(false);
    const [formSubmitted, setFormSubmitted] = useState(false);

    const onNameChange = (e) => {
        setName(e.target.value);
    };

    const onFromDateChange = (e) => {
        setFromDate(e.target.value);
    };

    const onToDateChange = (e) => {
        setToDate(e.target.value);
    };

    const onTotalBudgetChange = (e) => {
        setTotalBudget(e.target.value);
    };

    const onDailyBudgetChange = (e) => {
        setDailyBudget(e.target.value);
    };

    const onFileChange = (e) => {
        setCreativeUploads([...creativeUploads, e.target.files[0]]);
    };

    const addMoreFileInput = () => {
        setFileCount(fileCount + 1);
    };

    const update = () => {
        setLoading(true);
        setFormSubmitted(true);
        const data = prepareCampaignFormData({
            requestType: "put",
            name,
            fromDate,
            toDate,
            totalBudget,
            dailyBudget,
            creativeUploads,
        });
        axios
            .post(`/api/v1/campaigns/${id}`, data, {
                headers: {
                    "content-type": "multipart/form-data",
                },
            })
            .then((response) => {
                setLoading(false);
                Swal.fire({
                    icon: "success",
                    text:
                        response?.data?.data?.message ||
                        "Campaign Updated Successfully",
                });
                setTimeout(() => {
                    window.location = "/campaigns";
                }, 2000);
            })
            .catch((error) => {
                setLoading(false);
                if (error?.response?.status === 400) {
                    setErrors(
                        Object.keys(error?.response?.data?.errors).map(
                            (item) => error?.response?.data?.errors[item][0]
                        ) || []
                    );
                    setErrorMessage(error?.response?.data?.message);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text:
                            error?.response?.data?.message ||
                            "Something went wrong!",
                    });
                }
            });
    };

    useEffect(() => {
        setFetchingCampaign(true);
        axios
            .get(`/api/v1/campaigns/${id}`)
            .then((response) => {
                setName(response?.data?.data?.name || "");
                setFromDate(
                    new Date(response?.data?.data?.from_date)
                        .toISOString()
                        .slice(0, 10) || ""
                );
                setToDate(
                    new Date(response?.data?.data?.to_date)
                        .toISOString()
                        .slice(0, 10) || ""
                );
                setTotalBudget(response?.data?.data?.total_budget || "");
                setDailyBudget(response?.data?.data?.daily_budget || "");
                setCreatives(response?.data?.data?.creative_upload || []);
                setFetchingCampaign(false);
            })
            .catch((error) => {
                setCampaignFetchingFailed(true);
                setFetchingCampaign(false);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text:
                        error?.response?.data?.message ||
                        "Something went wrong!",
                });
            });
        return () => setCampaignFetchingFailed(false);
    }, []);
    console.log({
        name,
        fromDate,
        toDate,
        totalBudget,
        dailyBudget,
        creatives,
    });
    return (
        <>
            {fetchingCampaign && (
                <div className="vw-100 vh-100">
                    <div className="d-flex justify-content-center my-10">
                        <div
                            className="spinner-border text-info"
                            style={{ width: "3rem", height: "3rem" }}
                            role="status"
                        >
                            <span className="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            )}
            {errors.length > 0 && (
                <div className="row">
                    <div className="col-md-12">
                        <div className="alert alert-danger">
                            <p className="text-red">{errorMessage || ""}</p>
                            <ul className="mb-0">
                                {errors.map((item, key) => (
                                    <li key={key}>{item}</li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            )}
            {!campaignFetchingFailed && (
                <>
                    <Input
                        label="Name"
                        onChange={onNameChange}
                        value={name}
                        required={true}
                    />
                    <div className="row">
                        <DateInput
                            label="From Date"
                            onChange={onFromDateChange}
                            required={true}
                            value={fromDate}
                            fullWidth={false}
                        />
                        <DateInput
                            label="To Date"
                            onChange={onToDateChange}
                            required={true}
                            value={toDate}
                            fullWidth={false}
                        />
                    </div>
                    <div className="row">
                        <NumberInput
                            label={"Total Budget ($)"}
                            value={totalBudget}
                            onChange={onTotalBudgetChange}
                            required={true}
                            fullWidth={false}
                        />
                        <NumberInput
                            label={"Daily Budget ($)"}
                            value={dailyBudget}
                            onChange={onDailyBudgetChange}
                            required={true}
                            fullWidth={false}
                        />
                    </div>
                    <div className="row">
                        <div className="mb-3">
                            <label className="form-label">
                                Upload Creatives
                            </label>
                            <FileInput
                                fileCount={fileCount}
                                onChange={onFileChange}
                            />
                            <button
                                type="button"
                                className="btn btn-sm btn-outline-dark float-end mb-10"
                                onClick={addMoreFileInput}
                            >
                                Add More
                            </button>
                        </div>
                    </div>
                    {creatives?.length > 0 && (
                        <CreativesItem creativeUploads={creatives} />
                    )}
                    <div className="row mb-3">
                        <div className="col-md-12">
                            <button
                                type="submit"
                                className="btn btn-success my-4 float-end"
                                onClick={update}
                                style={{ minWidth: "70px" }}
                                disabled={loading}
                            >
                                {loading ? (
                                    <div
                                        className="spinner-border spinner-border-sm text-light"
                                        role="status"
                                    >
                                        <span className="visually-hidden">
                                            Loading...
                                        </span>
                                    </div>
                                ) : (
                                    "Update"
                                )}
                            </button>
                        </div>
                    </div>
                </>
            )}
        </>
    );
};

export default Edit;

if (document.getElementById("update-campaign")) {
    let editDom = document.getElementById("update-campaign");
    ReactDOM.render(<Edit id={editDom.dataset.id} />, editDom);
}
