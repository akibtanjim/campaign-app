export const prepareCampaignFormData = ({
    requestType = "post",
    name,
    fromDate,
    toDate,
    totalBudget,
    dailyBudget,
    creativeUploads,
}) => {
    const formData = new FormData();
    formData.append("name", name);
    formData.append("from_date", fromDate);
    formData.append("to_date", toDate);
    formData.append("total_budget", totalBudget);
    formData.append("daily_budget", dailyBudget);
    if (requestType === "put") formData.append("_method", "PUT");
    if (creativeUploads.length) {
        for (const index in creativeUploads) {
            formData.append(
                "creative_upload[" + index + "]",
                creativeUploads[index]
            );
        }
    }
    return formData;
};
