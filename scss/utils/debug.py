""" Debugging utilities """

####################################################################################################
# Form Debugging Utilities #########################################################################
####################################################################################################
def debug_form(form, **kwargs):
    """
    Prints the data of a form for debugging purposes.

    Args:
        form: The form object to print the data from.
        **kwargs: Additional keyword arguments.
            - divider (str): The divider string to use. Default is "------------------------------".
            - label (str): The label to display before printing the form data. Default is None.

    Returns:
        None.

    Examples:
        >>> debug_form(form)
        ------------------------------
        field1: value1
        field2: value2
        ------------------------------
    """
    _divider = kwargs.get("divider", "------------------------------")
    _label = kwargs.get("label", None)

    if form.data:
        print(_divider)
        if _label:
            print(_label)
            print(_divider)
        for field in form.data:
            print(f"{field}: {form.data[field]}")
        print(_divider)
