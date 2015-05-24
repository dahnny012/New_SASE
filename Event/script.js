moment().format();

Event = React.createClass({
    getInitialState: function() {
        return {
            name: "",
            date: "",
            location: "",
            time: "",
            description: "",
            fb: ""
        };
    },

    componentDidMount: function() {
        $.get(this.props.source, function(result) {
            var result = JSON.parse(result).events[0];
            if (this.isMounted()) {
                this.setState({
                    name: result.name,
                    date: result.data,
                    location: result.location,
                    time: result.time,
                    description: result.description,
                    fb: result.fb
                });
            }
        }.bind(this));
    },

    render: function() {
        return ( <div>{this.state.name}</div>);
}
});



React.render( <Event source = "https://new-sase-dahnny012.c9.io/API/event.php"/> 
, document.getElementById("events"));