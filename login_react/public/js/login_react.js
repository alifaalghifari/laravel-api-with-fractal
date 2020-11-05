class Login extends React.Component {
    constructor(props) {
        super(props);
        this.myRef = React.createRef();
        this.state = {
            name: '',
            password: '',
            typeP: 'password',
            img: ['show.png', 'hide.png'],
            imgI: 1
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleImg = this.handleImg.bind(this);
    }


    handleChange(event) {
        const target = event.target;
        const name = target.name;
        const value = target.value

        this.setState({ [name]: value })
    }

    handleImg() {
        const node = this.myRef.current.type;
        const value = node === 'password' ? 'text' : 'password';
        const img = this.state.imgI === 0 ? 1 : 0;
        this.setState({
            typeP: value,
            imgI: img
        })
    }

    render() {
        return (
            <div className="header">
                <h2>Login</h2>

                <form onSubmit={this.handleSubmit} className="fill" >
                    <label>
                        <input type="text" name="name" value={this.state.name} onChange={this.handleChange} placeholder="Name" autoComplete="off" />
                        <span>Name</span></label>
                    <label>
                        <input ref={this.myRef} type={this.state.typeP} name="password" value={this.state.password} onChange={this.handleChange} placeholder="Password" />
                        <span>password</span>
                        <img className="img" src={"img/" + this.state.img[this.state.imgI]} alt="" onClick={this.handleImg} />
                    </label>
                    <input type="submit" value="Submit" />
                </form>
            </div>
        );
    }
}


ReactDOM.render(<Login />, document.getElementById('form'))
